## 什麼是 DNS？Google 有提供的公開的 DNS，對 Google 的好處以及對一般大眾的好處是什麼？
- DNS 就是儲存網域與IP位置的伺服器資料庫
- 對一般大眾的好處:速度較快，安全性較高
- 對 GOOGLE 的好處:他可以蒐集一些資料，EX:了解那些時段該在那些網域下適合的廣告
## 什麼是資料庫的 lock？為什麼我們需要 lock？
- 為了避免同時間太多人，存取、修改資料庫內容造成衝突以及超賣所產生的機制，
## NoSQL 跟 SQL 的差別在哪裡？
1. 沒有固定的格式
2. 無法使用 JOIN 來關聯資料庫
3. 用類似於 JSON 的keyvalue格式來儲存資料
## 資料庫的 ACID 是什麼？
1. 原子性(atomicity): 所有改變都必須成功，如果一則失敗，則全不予改變
2. 一致性(consistency): 質量守恆、等價交換，有捨就得，在資料的交易前後，不管內部做了多少筆交易，其數目的總數是一定的
3. 隔離性(isolation): 多筆交易不會互相影響，也就是利用 LOCK 的機制
4. 持久性(durability): 資料在交易完成後，資料不會不見，如果中途遇見錯誤，會繼續完成原本的交易