## CSS 預處理器是什麼？我們可以不用它嗎？
1. 隨著網頁越來越複雜，用傳統的 CSS 寫法，因為重複性太高所以產生了預處理器，將 CSS 變得不那麼繁重、複雜，方便維護以及開發。
2. 當然可以不用他，只是效率會降低


## 請舉出任何一個跟 HTTP Cache 有關的 Header 並說明其作用。
1. Last-Modified、If-Modified-Since
Sever 端可以在回傳 response 的時候，多加一個 Last-Modified 的 header ，表示上一次更新的時間
而 瀏覽器在發送 request 的時候可以加上 If-Modified-Since 的 header ，當 Last-Modified 過期時，可以依此向 sever 要求 更改後的資料，
2. Etag、If-None-Match
運用 Last-Modified 會有個小問題就是，如果資料並沒有更新指使打開過，也會判定為更新，所以可以利用 Etag 來驗證檔案是否更動
Etag 會產生類似於 hash 的值，可依此來判定，sever 端在送出 response 得時候帶上 Etag 而瀏覽器在發送 request 時，帶上 If-None-Match 來驗證資料是否更動，如果更動則重新下載。

## Stack 跟 Queue 的差別是什麼？
- Stack
    就向疊盤子一樣，第一個進去的是最後一個出來，最後進則是第一個出來，後進先出
- Queue
    如同排隊，第一個進去第一個出來，先進先出
## 請去查詢資料並解釋 CSS Selector 的權重是如何計算的（不要複製貼上，請自己思考過一遍再自己寫出來）
1. 如果遇到相同權重，則後面取代前面
2. !important 權重最大 10000 盡量少用
3. 元素標籤與偽元素(ex ::before) 個位數等級
4. class 、偽類 十位數等級
5. id 百位數等級
6. 直接寫在 html 的標籤後面 style="background-color:red"，千位數等級
7. 疊越多東西權重越大，看起來也越複雜，更不易改寫