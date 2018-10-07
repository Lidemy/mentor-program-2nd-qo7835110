## 資料庫欄位型態 VARCHAR 跟 TEXT 的差別是什麼
- varchar 
1. 必須預設長度
2. 可以擁有默認值
3. 查詢速度較快於 text
- text
1. 不用預設長度
2. 無法擁有默認值
3. 查詢速度較慢
 


## Cookie 是什麼？在 HTTP 這一層要怎麼設定 Cookie，瀏覽器又會以什麼形式帶去 Server？

    cookie 是瀏覽器儲存在用戶端上的一個文本文件，是純文本不涵代碼，server 端可以利用 set-cookie 來創建 cookie 並設定時間讓他自然失效，  
    瀏覽器則可以利用 cookie 來辨認用戶狀態。
    也可以利用 JavaScript 來創建、修改 cookie 但如果是HttoOnly coolie 則不行。
    


## 我們本週實作的會員系統，你能夠想到什麼潛在的問題嗎？
  會員的資料會在 header 裡面被看到如果有心人是想要繞過帳號驗證，預先準備好 cookie 就可以繞過驗證

