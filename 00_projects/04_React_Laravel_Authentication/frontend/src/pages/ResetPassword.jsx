import React, { useState } from 'react';
import {useParams} from 'react-router-dom';
import { useResetPasswordMutation } from "../services/userAuthApi"

const ResetPassword = () => {
    const [passwordData, setPasswordData] = useState({
        password: '',
        confirm_password: '',
      });

    const handleInputChange = (e) => {
        const {name, value} = e.target
        setPasswordData({
            ...passwordData,
            [name]: value
        });
    };

    const [resetPassword, {isError, isSuccess, isLoading}] = useResetPasswordMutation();
    const {token} = useParams();

  const handleChangePassword = async (e) => {
    e.preventDefault();
    // Validate
    if (passwordData.password !== passwordData.confirm_password) {
      alert('password and confirm_password do not match');
      return;
    }

    // change password logic
    const res = await resetPassword({passwordData, token});
    console.log(res);

    if(res?.data?.status === 'success') {
      console.log(res.data.message);
      return;
    }

    if(res?.error?.data?.status === 'failed'){
      console.log(res.error.data.message);
      return;
    }
  }

  return (
      <div className="col-md-6">
        <div className="card">
          <div className="card-header">
            <h4>Reset Password</h4>
          </div>
          <div className="card-body">
            <form onSubmit={handleChangePassword}>
              <div className="mb-3">
                <label htmlFor="password" className="form-label">Password</label>
                <input
                  type="password" className="form-control" id="password" name="password" value={passwordData.password} onChange={handleInputChange} required
                />
              </div>
              <div className="mb-3">
                <label htmlFor="confirm_password" className="form-label">Confirm Password</label>
                <input type="password" className="form-control" id="confirm_password" name="confirm_password" value={passwordData.confirm_password} onChange={handleInputChange} required
                />
              </div>
              <button type="submit" className="btn btn-primary" disabled={isLoading}>{isLoading ? "saving..." : "Save Password"}</button>
            </form>
          </div>
        </div>
      </div>
  )
}

export default ResetPassword