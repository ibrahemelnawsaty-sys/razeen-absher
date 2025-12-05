import { exec } from 'child_process';
import { promisify } from 'util';

const execPromise = promisify(exec);

const scripts = [
  { name: 'الصفحات العامة', file: 'screenshots-public.js' },
  { name: 'المستخدم العادي', file: 'screenshots-user.js' },
  { name: 'الجهة الحكومية', file: 'screenshots-government.js' },
  { name: 'المستثمر', file: 'screenshots-investor.js' },
  { name: 'السوبر أدمن', file: 'screenshots-admin.js' },
];

async function runAll() {
  console.log('🚀 بدء التقاط جميع الصور...\n');
  
  for (const script of scripts) {
    console.log(`\n${'='.repeat(60)}`);
    console.log(`📸 تشغيل: ${script.name}`);
    console.log('='.repeat(60));
    
    try {
      const { stdout, stderr } = await execPromise(`node ${script.file}`);
      console.log(stdout);
      if (stderr) console.error(stderr);
    } catch (error) {
      console.error(`❌ خطأ في ${script.name}:`, error.message);
    }
    
    // انتظار 3 ثواني بين كل سكريبت
    await new Promise(resolve => setTimeout(resolve, 3000));
  }
  
  console.log('\n✨ انتهى التقاط جميع الصور!');
  console.log('📁 جميع الصور محفوظة في مجلد screenshots/');
}

runAll().catch(console.error);
