import {test, expect} from '@playwright/test';

const P_ARS = '8795';
const INET_ID = '2RDZJDMF';
const USER_NUM = '67561290';
const PIN = '3879';

test('Auto poll', async ({page}) => {
    const stadium_no = process.env.STADIUM_NO;
    const boat_no = process.env.BOAT_NO;
    const money_unit = process.env.MONEY_UNIT;
    if (stadium_no === undefined) {
        fail('stadium_no is empty')
    }
    //3分前に投票するため実際には使わない
    // const race_no = process.env.RACE_NO;
    // if (race_no === undefined) {
    //     fail('race_no is empty')
    // }
    if (boat_no === undefined) {
        fail('boat_no is empty')
    }
    if (money_unit === undefined) {
        fail('money_unit is empty')
    }

    await page.goto('https://ib.mbrace.or.jp/');
    await page.waitForTimeout(2000);
    await page.getByRole('textbox', {name: '半角数字6～10桁'}).click();
    await page.getByRole('textbox', {name: '半角数字6～10桁'}).fill('05654401');
    await page.getByRole('textbox', {name: '半角数字4～6桁'}).click();
    await page.getByRole('textbox', {name: '半角数字4～6桁'}).fill('1594');
    await page.getByRole('textbox', {name: '半角英数字6～8桁'}).click();
    await page.getByRole('textbox', {name: '半角英数字6～8桁'}).fill('VJ3s4x');
    const page1Promise = page.waitForEvent('popup');
    await page.getByRole('button', {name: 'ログインする'}).click();
    const page1 = await page1Promise;
    console.log(page1.innerText('#currentBetLimitAmount'));
    await page1.locator('ul.selectBox > li:nth-child(' + stadium_no + ')').click();
    await page1.getByRole('link', {name: '単勝'}).click();
    await page1.getByRole('link', {name: boat_no, exact: true}).click();
    await page1.locator('#amount').click();
    await page1.locator('#amount').press('NonConvert');
    await page1.locator('#amount').fill(money_unit);
    await page1.getByRole('link', {name: 'ベットリストに追加'}).click();
    await page1.getByRole('link', {name: '投票入力完了'}).click();
    await page1.locator('#amount').click();
    await page1.locator('#amount').fill(money_unit + '00');
    await page1.locator('#amount').press('Tab');
    await page1.locator('#pass').fill('clen62');
    await page1.getByRole('link', {name: '投票する'}).click();
    await page1.getByRole('link', {name: 'OK'}).click();
});