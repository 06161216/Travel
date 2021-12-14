import React,{Component} from 'react'
import socketio from 'socket.io-client'
import ReactDOM from 'react-dom';

// const socket = socketio.connect('http://localhost:8080')
const socket = socketio.connect('https://3adb4abdd1ce46448268d90f46f0c329.vfs.cloud9.ap-northeast-1.amazonaws.com/chat/3')

class Form extends Component {
  constructor(props){
    super(props)
    this.state = {
      name: '',
      message: ''
      //このcomponentで扱うnameとmessageの初期値を設定する。
    }
  }

  nameChanged(e){
    this.setState({name: e.target.value})
  }
  //このイベントの発生時、this.state.nameにvalueの値が入る
  messageChanged(e){
    this.setState({message: e.target.value})
  }
  //このイベントの発生時、this.state.messageにvalueの値が入る
  send(){
    socket.emit('chatMessage',{
      name: this.state.name,
      message: this.state.message
    })
    this.setState({message: ''})
  }
  //このイベント発生時、socket.io-clientがlocahostにnameとmessageの値が入ったchatMessageを全てのユーザーに送信する。
  //その後、messageの値だけを初期値に戻す。

  render(){
    return(
      <div id='Form'>
        <div className='Name'>
          名前:
          <br />
          <input value={this.state.name} onChange={e => this.nameChanged(e)} />
　　　　　　//名前フォーム内に何か打ち込まれたらthis.state.nameに打ち込まれたものが入り、this.nameChangedイベントが発生する
        </div>
        <br />
        <div className='Message'>
          メッセージ:
          <br />
          <input value={this.state.message} onChange={e => this.messageChanged(e)} />
　　　　　　//メッセージフォーム内に何か打ち込まれたらthis.state.nameに打ち込まれたものが入り、this.messageChangedイベントが発生する
        </div>
        <button className='send' onClick={e => this.send()}>送信</button>
　　　　　//ボタンを押されたらsendが発生する
      </div>
    )
  }
}

// export default Form
ReactDOM.render(
  <ChatApp />,
  document.getElementById('root')
)