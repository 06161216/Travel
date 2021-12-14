import React from 'react';
import ReactDOM from 'react-dom';

class MyComponent extends React.Component {
    constructor(props,context){
        super(props,context)
        this.state = {
            viewText : 'テストページ',
            viewFlg  : 1,
        }
    }
    renderChange(){
        // viewFlgの状態を切替(0 <-> 1)
        let newFlg = this.state.viewFlg == 1 ? 0 : 1;
        this.setState({viewFlg : newFlg });
    }
    render(){
        return (
            <div>
                <h1>Hello! World.</h1>
                <p>このページは{this.state.viewFlg == 1 ? this.state.viewText : 'サンプルページ'}です。</p>
                <button onClick={()=>this.renderChange()}>切替</button>
            </div>
        )
    }
}

ReactDOM.render(
  <MyComponent />,
  document.getElementById('main') /* Reactが生成したコードを#mainに書き出す */
);
