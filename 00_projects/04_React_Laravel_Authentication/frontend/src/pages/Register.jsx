
import React, { useState } from 'react';
import {useNavigate} from 'react-router-dom';
import { useRegisterUserMutation } from "../services/userAuthApi"
import { Form, Button, Container, Row, Col } from 'react-bootstrap';
import { useDispatch } from 'react-redux';
import { setUserToken } from '../features/authSlice';
import { Link } from 'react-router-dom';

function Register() {
  const dispatch = useDispatch();
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    confirm_password: '',
    terms_and_condition: false
  });

  const navigate = useNavigate();
  const [registerUser, {isLoading, isError, isSuccess}] = useRegisterUserMutation();

  const [errors, setErrors] = useState({});

  const handleChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === 'checkbox' ? checked : value
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();

    // form validation
    const newErrors = {};
    if (!formData.name) newErrors.name = 'Name is required';
    if (!formData.email) newErrors.email = 'Email is required';
    if (!formData.password) newErrors.password = 'Password is required';
    if (formData.password.length < 4)
      newErrors.password = 'Password must be at least 4 characters long';
    if (formData.password !== formData.confirm_password)
      newErrors.confirm_password = 'Passwords do not match';
    if (!formData.terms_and_condition)
      newErrors.terms_and_condition = 'You must accept the terms and conditions';
    
    if (Object.keys(newErrors).length > 0) {
        setErrors(newErrors);
    } else {

    // Submit form logic
    // console.log('Form Submitted', formData);
    const res = await registerUser(formData);
    console.log(res);
      
    // Reset form
    setFormData({
        name: '',
        email: '',
        password: '',
        confirm_password: '',
        terms_and_condition: false
    });

    if(res?.data?.status === 'success') {
      // store Token here
      dispatch(setUserToken(res.data.token))
      // localStorage.setItem('token', JSON.stringify(res.data.token))
      navigate('/dashboard');
    }
    if(res?.data?.status === 'failed') {
      console.log(res.data.message);
    }
  }
  };

  return (
    <Container className="mt-4">
      <Row className="justify-content-md-center">
        <Col md={6}>
          <h2 className="text-center">User Registration</h2>
          <Form onSubmit={handleSubmit}>
            {/* Name Field */}
            <Form.Group className="mb-3" controlId="formName">
              <Form.Label>Name</Form.Label>
              <Form.Control type="text" name="name" value={formData.name} onChange={handleChange}
                isInvalid={!!errors.name}
              />
              <Form.Control.Feedback type="invalid">{errors.name}</Form.Control.Feedback>
            </Form.Group>

            {/* Email Field */}
            <Form.Group className="mb-3" controlId="formEmail">
              <Form.Label>Email address</Form.Label>
              <Form.Control type="email" name="email" value={formData.email} onChange={handleChange}
                isInvalid={!!errors.email}
              />
              <Form.Control.Feedback type="invalid">{errors.email}</Form.Control.Feedback>
            </Form.Group>

            {/* Password Field */}
            <Form.Group className="mb-3" controlId="formPassword">
              <Form.Label>Password</Form.Label>
              <Form.Control
                type="password" name="password" value={formData.password} onChange={handleChange}
                isInvalid={!!errors.password}
              />
              <Form.Control.Feedback type="invalid">{errors.password}</Form.Control.Feedback>
            </Form.Group>

            {/* Confirm Password Field */}
            <Form.Group className="mb-3" controlId="formconfirm_password">
              <Form.Label>Confirm Password</Form.Label>
              <Form.Control type="password" name="confirm_password" value={formData.confirm_password} onChange={handleChange}
                isInvalid={!!errors.confirm_password}
              />
              <Form.Control.Feedback type="invalid">{errors.confirm_password}</Form.Control.Feedback>
            </Form.Group>

            {/* Terms and Conditions Checkbox */}
            <Form.Group className="mb-3" controlId="formterms_and_conditions">
              <Form.Check type="checkbox" label="I accept the terms and conditions" name="terms_and_condition" checked={formData.terms_and_condition} onChange={handleChange} isInvalid={!!errors.terms_and_condition}
              />
              <Form.Control.Feedback type="invalid">{errors.terms_and_condition}</Form.Control.Feedback>
            </Form.Group>

            {/* Submit Button */}
            <Button variant="primary" type="submit" disabled={isLoading}>
              Register
            </Button>
          </Form>
          <Link to="/login">
            <p className='text-center mt-2'>Already have an account? Login</p>
          </Link>
        </Col>
      </Row>
    </Container>
  );
}

export default Register;
