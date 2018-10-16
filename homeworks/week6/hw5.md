## 請說明 SQL Injection 的攻擊原理以及防範方法
- 在輸入的字串夾帶 SQL 指令或是特殊的字元，使的伺服器執行惡意的程式碼
- 利用 prepare statement 或是過濾掉單雙引號

## 請說明 XSS 的攻擊原理以及防範方法
- 攻擊者利用網站的可輸入資料的元素，植入惡意的程式碼，讓網站讀取時執行這段攻擊者所提供的程式碼
- 前端可利用 innerText 以及 creatElement 等方式取代 innerHTML 來防範 XSS
- 後端可以利用跳脫字元來輸出資料，如 php 的 htmlspecialchars
## 請說明 CSRF 的攻擊原理以及防範方法
- 在使用者已經登入的情況下，誘使使用者點擊含有惡意的程式碼的連結，即可繞過身分驗證，而執行惡意程式碼
- 檢查 referer 在 request 中會帶有一個 referer 的欄位，可以確認其 domain 是否合法，如不合法就 reject。  
加上驗證碼(ex: 簡訊、圖形)。
- 前端可在 set-cookie 後面多加一個 SameSite 讓 cookie 只允許在 same site 使用

## 請舉出三種不同的雜湊函數
1. MD5
2. SHA-1
3. RIPEMD-160

## 請去查什麼是 Session，以及 Session 跟 Cookie 的差別
### session
- 當與用戶做完身分驗證後，產生一組亂數對應 id 然後傳入 cookie ，當用戶發送請求時，就可以將此亂數與 id 做驗證，來判對是否為同一用戶，不會因為 cookie 被竄改而盜用他人身分。
### 兩者差別
- cookie 儲存於用戶端，而 session 可以儲存在內存、 cookie 、資料庫、緩存。
- cookie 因為存放於用戶端所以可以被任意修改，並不安全，不是何用來存放私密資料，所以需要利用 session 這個機制來加強驗證身分
## `include`、`require`、`include_once`、`require_once` 的差別
- 有 once 會檢查是否有重複引用的檔案，如有重複則不重複引用
- 當遇到錯誤時，require 會中斷執行，並顯示 error ，include 則會發出警告並繼續執行