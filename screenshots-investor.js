import puppeteer from 'puppeteer';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const credentials = {
  email: 'investor@invest.com',
  password: 'password'
};

const pages = [
  { name: '01-dashboard', url: '/dashboard', waitFor: 4000 },
  { name: '02-area-analysis', url: '/investor/area-analysis', waitFor: 3000 },
  { name: '03-risk-map', url: '/investor/risk-map', waitFor: 3000 },
  { name: '04-investment-reports', url: '/investor/investment-reports', waitFor: 3000 },
  { name: '05-map', url: '/map', waitFor: 5000 },
  { name: '06-profile', url: '/profile', waitFor: 2000 },
];

async function takeScreenshots() {
  console.log('🚀 بدء التقاط صور المستثمر...\n');
  
  const browser = await puppeteer.launch({
    headless: false,
    defaultViewport: { width: 1920, height: 1080 },
    args: ['--start-maximized']
  });

  const baseURL = 'http://absher.test';
  const screenshotsDir = path.join(__dirname, 'screenshots', 'investor');
  
  if (!fs.existsSync(screenshotsDir)) {
    fs.mkdirSync(screenshotsDir, { recursive: true });
  }

  const page = await browser.newPage();
  
  try {
    console.log('🔐 تسجيل الدخول...');
    await page.goto(`${baseURL}/login`, { waitUntil: 'networkidle0', timeout: 30000 });
    
    // انتظار ظهور حقل الإيميل
    await page.waitForSelector('input[type="email"]', { timeout: 10000 });
    await page.type('input[type="email"]', credentials.email, { delay: 100 });
    
    // انتظار ظهور حقل الباسورد
    await page.waitForSelector('input[type="password"]', { timeout: 5000 });
    await page.type('input[type="password"]', credentials.password, { delay: 100 });
    
    // الضغط على زر تسجيل الدخول
    await page.click('button[type="submit"]');
    
    // انتظار التوجيه
    await page.waitForNavigation({ waitUntil: 'networkidle0', timeout: 15000 });
    
    console.log('✅ تم تسجيل الدخول بنجاح\n');
    
    // انتظار إضافي للتأكد من تحميل Dashboard
    await new Promise(resolve => setTimeout(resolve, 3000));
    
    // التقاط الصور
    for (const pageInfo of pages) {
      try {
        console.log(`📷 التقاط: ${pageInfo.name}...`);
        
        await page.goto(`${baseURL}${pageInfo.url}`, { 
          waitUntil: 'networkidle0',
          timeout: 30000 
        });
        
        // انتظار تحميل الصفحة
        await new Promise(resolve => setTimeout(resolve, pageInfo.waitFor));
        
        // التقاط الصورة
        await page.screenshot({
          path: path.join(screenshotsDir, `${pageInfo.name}.png`),
          fullPage: true
        });
        
        console.log(`✅ تم حفظ: ${pageInfo.name}.png`);
        
      } catch (error) {
        console.error(`❌ خطأ في ${pageInfo.name}:`, error.message);
        
        // محاولة التقاط صورة للخطأ
        try {
          await page.screenshot({
            path: path.join(screenshotsDir, `ERROR-${pageInfo.name}.png`),
            fullPage: true
          });
          console.log(`⚠️ تم حفظ صورة الخطأ: ERROR-${pageInfo.name}.png`);
        } catch (e) {
          console.error(`❌ فشل حفظ صورة الخطأ`);
        }
      }
    }
    
  } catch (error) {
    console.error('❌ خطأ عام:', error.message);
    
    // محاولة التقاط صورة للخطأ العام
    try {
      await page.screenshot({
        path: path.join(screenshotsDir, `FATAL-ERROR.png`),
        fullPage: true
      });
    } catch (e) {
      console.error('❌ فشل حفظ صورة الخطأ العام');
    }
  }

  await browser.close();
  console.log('\n✨ انتهى! الصور في: screenshots/investor/');
}

takeScreenshots().catch(console.error);
