// تثبيت المكتبة أولاً: npm install puppeteer
import puppeteer from 'puppeteer';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// بيانات تسجيل الدخول
const credentials = {
  citizen: {
    email: 'abdullah.ahmed@falak.sa',
    password: 'password'
  },
  admin: {
    email: 'admin@falak.sa',
    password: 'password'
  }
};

// صفحات المواطن
const citizenPages = [
  { name: '01-home', url: '/user/home', waitFor: 2000 },
  { name: '02-analyze', url: '/user/analyze', waitFor: 2000 },
  { name: '03-search', url: '/user/search', waitFor: 2000 },
  { name: '04-reports', url: '/user/reports', waitFor: 2000 },
  { name: '05-rewards', url: '/user/rewards', waitFor: 2000 },
  { name: '06-notifications', url: '/user/notifications', waitFor: 2000 },
  { name: '07-profile', url: '/user/profile', waitFor: 2000 },
  { name: '08-help', url: '/user/help', waitFor: 2000 },
];

// صفحات المسؤول
const adminPages = [
  { name: 'dashboard', url: '/dashboard', waitFor: 3000 },
  { name: 'vehicles', url: '/vehicles', waitFor: 2000 },
  { name: 'reports', url: '/reports', waitFor: 2000 },
  { name: 'rewards', url: '/rewards', waitFor: 2000 },
  { name: 'cameras', url: '/admin/cameras', waitFor: 2000 },
  { name: 'patrols', url: '/admin/patrols', waitFor: 2000 },
  { name: 'users', url: '/admin/users', waitFor: 2000 },
  { name: 'settings', url: '/admin/settings', waitFor: 2000 },
];

async function takeScreenshots() {
  const browser = await puppeteer.launch({
    headless: false, // غيرها إلى true لو تبغى يشتغل في الخلفية
    defaultViewport: {
      width: 1920,
      height: 1080
    }
  });

  const baseURL = 'http://falak.test';
  
  // إنشاء مجلدات للصور
  const screenshotsDir = path.join(__dirname, 'screenshots');
  const citizenDir = path.join(screenshotsDir, 'citizen');
  const adminDir = path.join(screenshotsDir, 'admin');
  
  [screenshotsDir, citizenDir, adminDir].forEach(dir => {
    if (!fs.existsSync(dir)) {
      fs.mkdirSync(dir, { recursive: true });
    }
  });

  console.log('🚀 بدء التقاط الصور...\n');

  // ======================
  // صفحات المواطن
  // ======================
  console.log('📸 التقاط صفحات المواطن...');
  const citizenPage = await browser.newPage();
  
  // تسجيل الدخول كمواطن
  await citizenPage.goto(`${baseURL}/login`);
  await citizenPage.waitForSelector('input[type="email"]');
  await citizenPage.type('input[type="email"]', credentials.citizen.email);
  await citizenPage.type('input[type="password"]', credentials.citizen.password);
  await citizenPage.click('button[type="submit"]');
  await citizenPage.waitForNavigation({ waitUntil: 'networkidle0' });
  
  // التقاط صفحات المواطن
  for (const page of citizenPages) {
    try {
      console.log(`  📷 ${page.name}...`);
      await citizenPage.goto(`${baseURL}${page.url}`, { waitUntil: 'networkidle0' });
      await new Promise(resolve => setTimeout(resolve, page.waitFor));
      
      await citizenPage.screenshot({
        path: path.join(citizenDir, `${page.name}.png`),
        fullPage: true
      });
      
      console.log(`  ✅ تم حفظ ${page.name}.png`);
    } catch (error) {
      console.error(`  ❌ خطأ في ${page.name}:`, error.message);
    }
  }
  
  await citizenPage.close();

  // ======================
  // صفحات المسؤول
  // ======================
  console.log('\n📸 التقاط صفحات المسؤول...');
  const adminPage = await browser.newPage();
  
  // تسجيل الدخول كمسؤول (استخدام صفحة جديدة نظيفة)
  await adminPage.goto(`${baseURL}/login`, { waitUntil: 'networkidle0' });
  await new Promise(resolve => setTimeout(resolve, 2000));
  
  // التحقق من وجود حقل الإيميل
  try {
    await adminPage.waitForSelector('input[type="email"]', { timeout: 10000 });
    await adminPage.type('input[type="email"]', credentials.admin.email);
    await adminPage.type('input[type="password"]', credentials.admin.password);
    await adminPage.click('button[type="submit"]');
    await adminPage.waitForNavigation({ waitUntil: 'networkidle0' });
  } catch (error) {
    console.log('  ℹ️  المستخدم مسجل دخول بالفعل أو تم التوجيه تلقائياً');
  }
  
  // التقاط صفحات المسؤول
  for (const page of adminPages) {
    try {
      console.log(`  📷 ${page.name}...`);
      await adminPage.goto(`${baseURL}${page.url}`, { waitUntil: 'networkidle0' });
      await new Promise(resolve => setTimeout(resolve, page.waitFor));
      
      await adminPage.screenshot({
        path: path.join(adminDir, `${page.name}.png`),
        fullPage: true
      });
      
      console.log(`  ✅ تم حفظ ${page.name}.png`);
    } catch (error) {
      console.error(`  ❌ خطأ في ${page.name}:`, error.message);
    }
  }

  await adminPage.close();
  await browser.close();

  console.log('\n✨ تم الانتهاء! الصور محفوظة في مجلد screenshots/');
  console.log(`   📁 صفحات المواطن: screenshots/citizen/`);
  console.log(`   📁 صفحات المسؤول: screenshots/admin/`);
}

takeScreenshots().catch(console.error);
