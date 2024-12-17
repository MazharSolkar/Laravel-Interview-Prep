
import React, { useState } from 'react';
import {useNavigate} from 'react-router-dom';
import { useLoginUserMutation } from "../services/userAuthApi"
import { Form, Button, Container, Row, Col } from 'react-bootstrap';
import { useDispatch } from 'react-redux';
import { setUserToken } from '../features/authSlice';
import { Link } from 'react-router-dom';

function Login() {
  const navigate = useNavigate();
  const dispatch = useDispatch();
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    confirm_password: '',
    terms_and_condition: false
  });

  const [loginUser, {isLoading, isError, isSuccess}] = useLoginUserMutation();

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData({
      ...formData,
      [name]: value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    const res = await loginUser(formData);
    // console.log(res);

    if(res?.error?.data?.status === 'failed'){
      console.log(res.error.data.message);
      return;
    }

    if(res?.data?.status === 'success'){
      // store Token
      dispatch(setUserToken(res.data.token))
      navigate('/dashboard');
      return;
    }
  };

  return (
    <Container className="mt-4">
      <Row className="justify-content-md-center">
        <Col md={6}>
          <h2 className="text-center">User Login</h2>
          <Form onSubmit={handleSubmit}>

            {/* Email Field */}
            <Form.Group className="mb-3" controlId="formEmail">
              <Form.Label>Email address</Form.Label>
              <Form.Control type="email" name="email" value={formData.email} onChange={handleChange} required />
            </Form.Group>

            {/* Password Field */}
            <Form.Group className="mb-3" controlId="formPassword">
              <Form.Label>Password</Form.Label>
              <Form.Control
                type="password" name="password" value={formData.password} onChange={handleChange} required />
            </Form.Group>

            {/* Submit Button */}
            <Button variant="primary" type="submit">
              Login
            </Button>
          </Form>
          <Link to="/login">
            <p className='text-center mt-2'>Don't have an account? Register</p>
          </Link>
        </Col>
      </Row>
    </Container>
  );
}

export default Login;
