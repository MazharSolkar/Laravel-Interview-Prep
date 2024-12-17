import {useGetLoggedInUserQuery, useLogoutUserMutation} from '../services/userAuthApi'
import { useEffect} from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { setUserInfo } from '../features/userSlice';
import { unsetUserInfo } from '../features/userSlice';
import { unsetUserToken } from '../features/authSlice';
import { useNavigate } from 'react-router-dom';

const UserProfile = () => {
    const dispatch = useDispatch();
    const navigate = useNavigate();
    const [logoutUser] = useLogoutUserMutation();

    // const token = JSON.parse(localStorage.getItem('token'));
    const {token} = useSelector(state => state.auth);
  
    const {data, isSuccess, isLoading} = useGetLoggedInUserQuery(token);

    // Accessing user data from Redux store
    const { name, email} = useSelector((state) => state.user);

    // Storing data in redux store
    useEffect(()=> {
      if(data && isSuccess) {
        dispatch(setUserInfo({
          name: data.user.name,
          email: data.user.email,
        }))
      }
    },[data, isSuccess])

    const handleLogout = async () => {
      const res = await logoutUser(token);
      console.log(res);
      
  
      if(res.data.status === "success") {
        // localStorage.removeItem('token');
        dispatch(unsetUserToken());
        dispatch(unsetUserInfo());
        navigate('/login');
        return
      }
      // if(res.data.)
    }
  return (
    <div className="card mb-4">
        <div className="card-header">
            <h3>User Profile</h3>
        </div>
        <div className="card-body">
            <p><strong>Username: </strong>{name}</p>
            <p><strong>Email: </strong>{email}</p>
        <button className="btn btn-danger" onClick={handleLogout} disabled={isLoading}>
            Logout
        </button>
        </div>
  </div>
  )
}

export default UserProfile