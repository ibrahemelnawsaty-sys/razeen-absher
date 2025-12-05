import puppeteer from 'puppeteer';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const credentials = {
  email: 'user@user.com',
  password: 'password'
};

const pages = [
  { name: '01-dashboard', url: '/dashboard', waitFor: 3000 },
  { name: '02-map', url: '/map', waitFor: 4000 },
  { name: '03-emergency-services', url: '/user/emergency-services', waitFor: 2000 },
  { name: '04-government-centers', url: '/user/government-centers', waitFor: 2000 },
  { name: '05-neighborhood-info', url: '/user/neighborhood-info', waitFor: 2000 },
  { name: '06-my-properties', url: '/user/my-properties', waitFor: 2000 },
  { name: '07-road-quality', url: '/user/road-quality', waitFor: 2000 },
  { name: '08-profile', url: '/profile', waitFor: 2000 },
];

async function takeScreenshotsWithParts(page, screenshotsDir, pageInfo, baseURL) {
  console.log(`📷 التقاط: ${pageInfo.name}...`);
  await page.goto(`${baseURL}${pageInfo.url}`, { waitUntil: 'networkidle0' });
  await new Promise(resolve => setTimeout(resolve, pageInfo.waitFor));
  
  const bodyHeight = await page.evaluate(() => document.body.scrollHeight);
  const viewportHeight = 1080;
  const maxScreenshotHeight = 5000;
  
  console.log(`   📏 ارتفاع الصفحة: ${bodyHeight}px`);
  
  if (bodyHeight <= maxScreenshotHeight) {
    await page.screenshot({
      path: path.join(screenshotsDir, `${pageInfo.name}.png`),
      fullPage: true
    });
    console.log(`✅ تم حفظ: ${pageInfo.name}.png`);
  } else {
    const numScreenshots = Math.ceil(bodyHeight / viewportHeight);
    console.log(`   📸 الصفحة طويلة! سيتم تقسيمها إلى ${numScreenshots} صورة`);
    
    for (let i = 0; i < numScreenshots; i++) {
      await page.evaluate((scrollY) => window.scrollTo(0, scrollY), i * viewportHeight);
      await new Promise(resolve => setTimeout(resolve, 500));
      
      await page.screenshot({
        path: path.join(screenshotsDir, `${pageInfo.name}-part${i + 1}.png`),
        clip: {
          x: 0,
          y: 0,
          width: 1920,
          height: Math.min(viewportHeight, bodyHeight - (i * viewportHeight))
        }
      });
      
      console.log(`   ✅ تم حفظ الجزء ${i + 1}/${numScreenshots}`);
    }
    
    await page.evaluate(() => window.scrollTo(0, 0));
  }
}

async function takeScreenshots() {
  console.log('🚀 بدء التقاط صور المستخدم العادي...\n');
  
  const browser = await puppeteer.launch({
    headless: false,
    defaultViewport: { width: 1920, height: 1080 }
  });

  const baseURL = 'http://absher.test';
  const screenshotsDir = path.join(__dirname, 'screenshots', 'user');
  
  if (!fs.existsSync(screenshotsDir)) {
    fs.mkdirSync(screenshotsDir, { recursive: true });
  }

  const page = await browser.newPage();
  
  try {
    console.log('🔐 تسجيل الدخول...');
    await page.goto(`${baseURL}/login`, { waitUntil: 'networkidle0' });
    await page.waitForSelector('input[type="email"]', { timeout: 5000 });
    await page.type('input[type="email"]', credentials.email);
    await page.type('input[type="password"]', credentials.password);
    await page.click('button[type="submit"]');
    await page.waitForNavigation({ waitUntil: 'networkidle0' });
    console.log('✅ تم تسجيل الدخول بنجاح\n');
    
    for (const pageInfo of pages) {
      try {
        await takeScreenshotsWithParts(page, screenshotsDir, pageInfo, baseURL);
      } catch (error) {
        console.error(`❌ خطأ في ${pageInfo.name}:`, error.message);
      }
    }
    
  } catch (error) {
    console.error('❌ خطأ عام:', error.message);
  }

  await browser.close();
  console.log('\n✨ انتهى! الصور في: screenshots/user/');
}

takeScreenshots().catch(console.error);
