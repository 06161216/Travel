import React,{Component} from 'react'
import socketio from 'socket.io-client'
import Form from './Form'

const socket = socketio.connect('https://3adb4abdd1ce46448268d90f46f0c329.vfs.cloud9.ap-northeast-1.amazonaws.com/chat/1')

class App  extends Component {
  constructor(props){
    super(props)
    this.state = {
      logs: []
    }
    //このcomponentで扱う配列logsの初期値を設定する
  }
  componentDidMount(){
  //このコンポーネントがDOMによって読み込まれた後の処理を設定する
    socket.on('chatMessage',(obj) => {
      //WebSocketサーバーからchatMessageを受け取った際の処理
      const logs2 = this.state.logs
      //logs2に今までのlogを格納する
      obj.key = 'key_' + (this.state.logs.length + 1)
      //メッセージ毎に独自のキーを設定して判別できるようにする
      console.log(obj)
      //consolelogにobj.key、name、messageを表示する
      logs2.unshift(obj)
      //配列の一番最初に最新のメッセージを入れる。
      //そうすることで新しいメッセージほど上に表示されるようになる
      this.setState({logs: logs2})
      //最新のkey、name、messageが入ったlogs2をlogsに入れる。
    })
  }

  render(){
    const messages = this.state.logs.map(e => (
      <div key={e.key}>
        <span>{e.name}</span>
        <span>: {e.message}</span>
        <p />
      </div>
    ))
    //ログの設定。今までのname、messageをkeyごとに表示する
    return(
      <div>
        <h1 id='title'>Reactチャット</h1>
        <ChatForm />
        <div id='log'>{messages}</div>
      </div>
    )
  }
}

// export default App
ReactDOM.render(
  <ChatApp />,
  document.getElementById('root')
)