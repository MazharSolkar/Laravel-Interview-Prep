import React, { useState } from 'react';
import {useNavigate} from 'react-router-dom';
import { useSendResetPasswordEmailMutation } from "../services/userAuthApi"
import { Form, Row, Col} from 'react-bootstrap';


const ForgotPassword = () => {
  const [email, setEmail] = useState('');

  const [sendResetPasswordEmail, {isSuccess, isError, isLoading}] = useSendResetPasswordEmailMutation();

  const handleChange = (e) => {
    setEmail(e.target.value)
  }

  const handleSubmit = async (e) => {
    e.preventDefault();
    // send email logic
    const res = await sendResetPasswordEmail(email);
    // console.log(res);
    
    if(res?.data?.status === 'success'){
      setEmail('');
      console.log(res.data.message);
      return;
    }
    if(res?.error?.data?.status === 'failed'){
      console.log(res.error.data.message);
      return;
    }
  }

  return (
    <div className='container'>
      <h1 className="my-4 text-center">Reset Password</h1>  
      <Row className='w-100 d-flex justify-content-center'>
        <Col md={6}>
          <Form onSubmit={handleSubmit}>
            {/* Email Field */}
            <Form.Group className="mb-3" controlId="formEmail">
              <Form.Label>Email address</Form.Label>
              <Form.Control type="email" name="email" value={email} onChange={handleChange} required
              />
            </Form.Group>
            <button className="btn btn-primary" type='submit' disabled={isLoading}>{isLoading ? 'Sending...' : 'Send Email'}</button>
          </Form>
        </Col>  
      </Row>
    </div>
  )
}

export default ForgotPassword