import {BrowserRouter, Routes, Route, Navigate} from 'react-router-dom';
import Register from './pages/Register';
import Login from './pages/Login';
import Dashboard from './pages/Dashboard';
import ForgotPassword from './pages/ForgotPassword';
import ResetPassword from './pages/ResetPassword';
import { useSelector } from 'react-redux';


function App() {
  const {token} = useSelector(state => state.auth)
  return (
    <>
    <BrowserRouter>
      <Routes>
        <Route path='/' element={<h1>Home Page</h1>} />
        {/* <Route path='/dashboard' element={<Dashboard />} />
        <Route path='/login' element={<Login />} />
        <Route path='/register' element={<Register />} /> */}
        <Route path='/dashboard' element={token? <Dashboard /> : <Navigate to='/login' />} />
        <Route path='/login' element={token ? <Navigate to="/dashboard" /> : <Login />} />
        <Route path='/register' element={token? <Navigate to="/dashboard" /> : <Register />} />
        <Route path='/forgot-password-page' element={<ForgotPassword />} />
        <Route path='/api/user/reset-password/:token' element={<ResetPassword />} />
      </Routes>
    </BrowserRouter>
    </>
  )
}

export default App
