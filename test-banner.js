const puppeteer = require('puppeteer');
(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    page.on('console', msg => console.log('PAGE LOG:', msg.text()));
    page.on('pageerror', error => console.log('PAGE ERROR:', error.message));
    
    await page.goto('https://omnichannel.biz.id/');
    await page.waitForSelector('#omni-consent-banner');
    
    // Check if banner is visible
    const isVisible = await page.$eval('#omni-consent-banner', el => {
        const style = window.getComputedStyle(el);
        return style.transform;
    });
    console.log('Banner initial transform:', isVisible);
    
    // Wait for the timeout to show banner
    await new Promise(r => setTimeout(r, 1500));
    
    const afterTimeout = await page.$eval('#omni-consent-banner', el => {
        const style = window.getComputedStyle(el);
        return style.transform;
    });
    console.log('Banner after timeout transform:', afterTimeout);
    
    // Click the X button
    console.log('Clicking X button...');
    await page.evaluate(() => {
        const btn = document.querySelector('button[onclick="omniConsentTempHide()"]');
        if(btn) btn.click();
        else console.log('X button not found!');
    });
    
    await new Promise(r => setTimeout(r, 1000));
    
    const afterClick = await page.$eval('#omni-consent-banner', el => {
        const style = window.getComputedStyle(el);
        return style.transform;
    });
    console.log('Banner after click transform:', afterClick);
    
    await browser.close();
})();
