## 什麼是 DOM？
- 將 html 的標籤視為一個模型，並依照標籤屬性產生不同的節點，使的 JavaScript 得以方便的選取操控它。
## 什麼是 Ajax？
- 透過瀏覽器的 API 可以不換頁就與 server 溝通的一樣技術。傳送必要的資料給予後端，後端再回應符合條件的資料到前端，而前端在加以渲染成畫面。
## HTTP method 有哪幾個？有什麼不一樣？
- GET  
  取得資料，
- POST 
  傳送資料，如果有重複的資料則會新增一個
- PUT
    與 POST 類似，但會覆蓋重複的資料
- PATCH
    修改已經存在的資料
- HEAD
    與 GET 類似，只是沒有 body 只會接收 herder的部分
- DELETE
    刪除資料
- OPTION
    用於取得資料庫支援的通信選項
## `GET` 跟 `POST` 有哪些區別，可以試著舉幾個例子嗎？
- GET
1. 資料傳遞量受到限制，因為是透過 URL 代參數。
2. 安全性較差，將資料放在 Header 上。
- POST
1. 資料傳遞量不受限制。
2. 安全性較佳，資料放在 Body。
## 什麼是 RESTful API？
    HTTP method 對應 CRUD 的一種風格標準
## JSON 是什麼？
    一種常見的資料格式，類似於 JS 的 Obiect
## JSONP 是什麼？
    因為同源政策的關係，使的有些資料庫，無法跨網域存取，所以利用 <script> 標籤的特性，可以獲得其他來源的資料。
## 要如何存取跨網域的 API？
- 利用JSONP
- 利用CORS