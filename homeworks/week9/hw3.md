1. 首先將 console.log(1) 放入call stack 然後執行釋放，輸出 1
2. 再來遇到 settimeout() 放入call stack ，發現他是web api 將他移到 web apis ，開始倒數，設定時間為0秒，所以馬上將 function(){console.log(2}) 移到 callback queue 裡排隊等候執行
3. 接下來是 console.log(3) 移到 call stack 執行釋放，輸出 3
4. 遇到 settimeout() 放入call stack ，發現他是web api 將他移到 web apis ，開始倒數，設定時間為0秒，所以馬上將 function(){console.log(4}) 移到 callback queue 裡排隊等候執行
5. console.log(5) 移到 call stack 執行釋放，輸出 5
6. 所有的 call stack 執行完畢，開始釋放 callback queue，queue 是先排得先執行，所以先執行，先將 function(){console.log(2)} 放入 call stack 然後發現裡面有 console.log(2) 所以再將 console.log(2) 放上去，沒有其他東西後，就開始釋放，因為是 stack 後面的先釋放， console.log(2) 再來是 function 本身，輸出 2
7. 同上， 先將 function(){console.log(4)} 放入 call stack 然後發現裡面有 console.log(4) 所以再將 console.log(4) 放上去，沒有其他東西後，就開始釋放，因為是 stack 後面的先釋放， console.log(4) 再來是 function 本身，輸出 4
8. 所輸出結果是 1 -> 3 -> 5 -> 2 -> 4