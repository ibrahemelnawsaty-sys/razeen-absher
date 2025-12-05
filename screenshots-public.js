import puppeteer from 'puppeteer';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const pages = [
  { name: '01-landing-page', url: '/', waitFor: 3000 },
  { name: '02-login', url: '/login', waitFor: 2000 },
  { name: '03-register', url: '/register', waitFor: 2000 },
  { name: '04-privacy-policy', url: '/privacy-policy', waitFor: 2000 },
  { name: '05-terms-conditions', url: '/terms-conditions', waitFor: 2000 },
];

async function takeScreenshots() {
  console.log('🚀 بدء التقاط صور الصفحات العامة...\n');
  
  const browser = await puppeteer.launch({
    headless: false,
    defaultViewport: { width: 1920, height: 1080 }
  });

  const baseURL = 'http://absher.test';
  const screenshotsDir = path.join(__dirname, 'screenshots', 'public');
  
  if (!fs.existsSync(screenshotsDir)) {
    fs.mkdirSync(screenshotsDir, { recursive: true });
  }

  const page = await browser.newPage();
  
  for (const pageInfo of pages) {
    try {
      console.log(`📷 التقاط: ${pageInfo.name}...`);
      await page.goto(`${baseURL}${pageInfo.url}`, { waitUntil: 'networkidle0' });
      await new Promise(resolve => setTimeout(resolve, pageInfo.waitFor));
      
      // الحصول على ارتفاع الصفحة الكامل
      const bodyHeight = await page.evaluate(() => document.body.scrollHeight);
      const viewportHeight = 1080;
      const maxScreenshotHeight = 5000; // الحد الأقصى لارتفاع صورة واحدة
      
      console.log(`   📏 ارتفاع الصفحة: ${bodyHeight}px`);
      
      // إذا كانت الصفحة أقصر من الحد الأقصى، خذ صورة واحدة
      if (bodyHeight <= maxScreenshotHeight) {
        await page.screenshot({
          path: path.join(screenshotsDir, `${pageInfo.name}.png`),
          fullPage: true
        });
        console.log(`✅ تم حفظ: ${pageInfo.name}.png`);
      } else {
        // الصفحة طويلة جداً، قسمها لصور متعددة
        const numScreenshots = Math.ceil(bodyHeight / viewportHeight);
        console.log(`   📸 الصفحة طويلة! سيتم تقسيمها إلى ${numScreenshots} صورة`);
        
        for (let i = 0; i < numScreenshots; i++) {
          // التمرير للموضع
          await page.evaluate((scrollY) => {
            window.scrollTo(0, scrollY);
          }, i * viewportHeight);
          
          // انتظار استقرار الصفحة
          await new Promise(resolve => setTimeout(resolve, 500));
          
          // التقاط الصورة
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
        
        // العودة لأعلى الصفحة
        await page.evaluate(() => window.scrollTo(0, 0));
      }
      
    } catch (error) {
      console.error(`❌ خطأ في ${pageInfo.name}:`, error.message);
    }
  }

  await browser.close();
  console.log('\n✨ انتهى! الصور في: screenshots/public/');
}

takeScreenshots().catch(console.error);
