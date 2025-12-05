import puppeteer from 'puppeteer';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const credentials = {
  email: 'super@admin.com',
  password: 'password'
};

const pages = [
  { name: '01-dashboard', url: '/dashboard', waitFor: 3000 },
  { name: '02-users-management', url: '/admin/users', waitFor: 2000 },
  { name: '03-entities-management', url: '/admin/entities', waitFor: 2000 },
  { name: '04-advanced-reports', url: '/admin/reports/advanced', waitFor: 3000 },
  { name: '05-map', url: '/map', waitFor: 4000 },
  { name: '06-profile', url: '/profile', waitFor: 2000 },
];

async function takeScreenshots() {
  console.log('🚀 بدء التقاط صور السوبر أدمن...\n');
  
  const browser = await puppeteer.launch({
    headless: false,
    defaultViewport: { width: 1920, height: 1080 }
  });

  const baseURL = 'http://absher.test';
  const screenshotsDir = path.join(__dirname, 'screenshots', 'admin');
  
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
        console.log(`📷 التقاط: ${pageInfo.name}...`);
        await page.goto(`${baseURL}${pageInfo.url}`, { waitUntil: 'networkidle0' });
        await new Promise(resolve => setTimeout(resolve, pageInfo.waitFor));
        
        await page.screenshot({
          path: path.join(screenshotsDir, `${pageInfo.name}.png`),
          fullPage: true
        });
        
        console.log(`✅ تم حفظ: ${pageInfo.name}.png`);
      } catch (error) {
        console.error(`❌ خطأ في ${pageInfo.name}:`, error.message);
      }
    }
    
  } catch (error) {
    console.error('❌ خطأ عام:', error.message);
  }

  await browser.close();
  console.log('\n✨ انتهى! الصور في: screenshots/admin/');
}

takeScreenshots().catch(console.error);
