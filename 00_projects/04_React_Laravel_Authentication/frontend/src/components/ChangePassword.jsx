import {useState} from 'react'
import { useChangeUserPasswordMutation } from '../services/userAuthApi';
import { useSelector } from 'react-redux';

const ChangePassword = () => {

    const [passwordData, setPasswordData] = useState({
        password: '',
        new_password: '',
        confirm_new_password: ''
      });
    
      const handleInputChange = (e) => {
        const {name, value} = e.target
        setPasswordData({
          ...passwordData,
          [name]: value
        });
      };

    const [changeUserPassword, {isSuccess, isError, isLoading}] = useChangeUserPasswordMutation();
    const {token} = useSelector(state => state.auth);

    const handleChangePassword = async (e) => {
      e.preventDefault();
      // Validate
      if (passwordData.new_password !== passwordData.confirm_new_password) {
        alert('New Password and Confirm New Password do not match');
        return;
      }
  
      // change password logic
      const res = await changeUserPassword({passwordData, token});
      console.log(res);
  
      if(res?.data?.status === 'success') {
        console.log(res.data.message);
        return;
      }
  
      if(res?.error?.data?.status === 'failed') {
        console.log(res.error.data.message);
        return;
      }

    // console.log(passwordData);

    };
  return (
    <div className="card">
        <div className="card-header">
        <h4>Change Password</h4>
        </div>
        <div className="card-body">
            <form onSubmit={handleChangePassword}>
                <div className="mb-3">
                <label htmlFor="password" className="form-label">Current Password</label>
                <input
                    type="password" className="form-control" id="password" name="password" value={passwordData.password} onChange={handleInputChange} required
                />
                </div>
                <div className="mb-3">
                <label htmlFor="new_password" className="form-label">New Password</label>
                <input type="password" className="form-control" id="new_password" name="new_password" value={passwordData.new_password} onChange={handleInputChange} required
                />
                </div>
                <div className="mb-3">
                <label htmlFor="confirm_new_password" className="form-label">Confirm New Password</label>
                <input type="password" className="form-control" id="confirm_new_password" name="confirm_new_password" value={passwordData.confirm_new_password} onChange={handleInputChange} required
                />
                </div>
                <button type="submit" className="btn btn-primary" disabled={isLoading}>{isLoading? 'Changing...' : 'Change Password'}</button>
            </form>
        </div>
  </div>
  )
}

export default ChangePassword