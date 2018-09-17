## 請找出三個課程裡面沒提到的 HTML 標籤並一一說明作用。
- select
    下拉式選單，中間可以包覆 option 來做為選項。
- button
    用來定義一個按鈕。
- script
    可以在標籤中，撰寫 JavaScript。
## 請問什麼是盒模型（box modal）
- 元素(element))、內邊距(padding)、邊框(border)、外邊距(margin)，以上合起來即為一個元素的整體範圍，稱之盒模型

## 請問 display: inline, block 跟 inline-block 的差別是什麼？
- block
一個區塊，會撐滿整行父元素，可以設定高度及寬度。
- inline
可以同時存在於同一行內，高度及寬度由內容物決定
- inline-block
同時具有 block 與 inline 特性，可以設定高度以及寬度，也不會占滿整行。

## 請問 position: static, relative, absolute 跟 fixed 的差別是什麼？
- static
1. 預設值
2. 不會特別被定位
- relative
1. 會被定位
2. 可加上下左右屬性
3. 定位起始位置為其一開始在瀏覽器上的位置
- absolute
1. 起始定位於父層有被定位的元素的左上角，如果沒有則繼續往上尋找，直到 body
2. 可加上下左右屬性
- fixed
1. 起始位置為瀏覽器的左上角
2. 會固定於瀏覽器上
3. 可加上下左右屬性