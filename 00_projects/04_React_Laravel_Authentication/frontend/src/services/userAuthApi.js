import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react'
// import type { Pokemon } from './types'

// Define a service using a base URL and expected endpoints
export const userAuthApi = createApi({
  reducerPath: 'userAuthApi',
  baseQuery: fetchBaseQuery({ baseUrl: 'http://127.0.0.1:8000/api/user' }),
  endpoints: (builder) => ({
    registerUser: builder.mutation({
      query: (formData) => {
        return {
            url: '/register',
            method: 'POST',
            body: formData,
            headers: {
                'content-type': 'application/json',
            }
        }
      },
    }),
    loginUser: builder.mutation({
      query: (formData) => {
        return {
            url: '/login',
            method: 'POST',
            body: formData,
            headers: {
                'content-type': 'application/json',
            }
        }
      },
    }),
    logoutUser: builder.mutation({
      query: (token) => {
        return {
            url: '/logout',
            method: 'POST',
            body: {},
            headers: {
                'Authorization': `Bearer ${token}`,
                'content-type': 'application/json',
            }
        }
      },
    }),
    changeUserPassword: builder.mutation({
      query: ({passwordData, token}) => {
        return {
            url: '/change-password',
            method: 'PUT',
            body: passwordData,
            headers: {
                'Authorization': `Bearer ${token}`,
                'content-type': 'application/json',
                'accept': 'application/json'
            }
        }
      },
    }),
    getLoggedInUser: builder.query({
      query: (token) => {
        return {
            url: '/user-details',
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'content-type': 'application/json',
            }
        }
      },
    }),
    sendResetPasswordEmail: builder.mutation({
      query: (email) => {
        return {
            url: '/send-reset-password-email',
            method: 'POST',
            body: {
              email
            },
            headers: {
                'content-type': 'application/json',
            }
        }
      },
    }),
    resetPassword: builder.mutation({
      query: ({passwordData, token}) => {
        return {
            url: `/reset-password/${token}`,
            method: 'POST',
            body: passwordData,
            headers: {
                'content-type': 'application/json',
            }
        }
      },
    }),
  }),
  })

// Export hooks for usage in functional components, which are
// auto-generated based on the defined endpoints
export const { 
  useRegisterUserMutation, 
  useLoginUserMutation, 
  useLogoutUserMutation, 
  useGetLoggedInUserQuery, 
  useChangeUserPasswordMutation, 
  useSendResetPasswordEmailMutation, 
  useResetPasswordMutation } = userAuthApi