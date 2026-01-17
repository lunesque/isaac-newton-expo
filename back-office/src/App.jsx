import { useState } from 'react';
import { Header } from './components/Header';
import { LogIn } from './components/LogIn';
import { Accounts } from './components/Accounts';
import { Tickets } from './components/Tickets';
import { Reservations } from './components/Reservations';
import './styles/app.scss';
// import './styles/base.css';




function App() {
  const [token, setToken] = useState(false);

  //can replace with local development server
  const linkToAPI = 'https://isaac-newton.alwaysdata.net/api';

  return (
    <>
    {token ? 
    <div>
      <Header setToken={setToken} linkToAPI={linkToAPI}/>
      <main>
        <Accounts linkToAPI={linkToAPI} />
        <Tickets linkToAPI={linkToAPI} />
        <Reservations linkToAPI={linkToAPI} />
      </main>
    </div>
    : <LogIn setToken={setToken} linkToAPI={linkToAPI} />
    }
    </>
  )
}

export default App
