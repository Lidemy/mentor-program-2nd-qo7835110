## 為什麼我們需要 React？可以不用嗎？
- 當然可以不使用框架，只是開方上的便利及便於維護
## React 的思考模式跟以前的思考模式有什麼不一樣？
- 最大的差異在於控制資料，一切的 DOM 都是依賴資料而產生變化，所以更加的直覺。

## state 跟 props 的差別在哪裡？
- state 是存在組件內的資料，可以改變，而 props 是父組件傳遞的資料，不可改變

## 請列出 React 的 lifecycle 以及其代表的意義
- initialization
組件創立階段

- mounting
組件渲染 DOM 元素階段
componentDidMount() DOM 渲染

- updation
組件的 state props 更新階段

shouldComponentUpdate()
如果回傳 false 則停止渲染


- unmounting
組件 DOM 元素移除階段