## gulp 跟 webpack 有什麼不一樣？我們可以不用它們嗎？
gulp 與 webpack 是不一樣的工具，gulp 可以將許多任務建立成一個流程，並自動執行，而 webpack 則是將所有檔案都視為模塊，並將它通通統整在一起

## hw3 把 todo list 這樣改寫，可能會有什麼問題？
效能會有問題，因為每次新增、修改都要重新渲染一次
## CSS Sprites 與 Data URI 的優缺點是什麼？
- CSS Sprites
優點:只需要取得一張圖片，減少重複發出 request 的時間，以此增進效能
缺點:需要透過 CSS 來多加處理，較為麻煩
- Data URI
優點:以文字的方式儲存圖片，所以可以直接寫在 html 裡面，不用另外下載也不用發出 request。
缺點: 無法透過 cache 緩存，檔案會比較大、沒有可讀性可言。
