import { createSlice } from '@reduxjs/toolkit'

const initialState = {
  email: '',
  name: ''
}

export const userSlice = createSlice({
  name: 'user',
  initialState,
  reducers: {
    setUserInfo: (state, action) => {
      state.email = action.payload.email;
      state.name = action.payload.name;
    },
    unsetUserInfo: (state, action) => {
      state.email = '';
      state.name = '';
    },

  },
})

export const { setUserInfo, unsetUserInfo } = userSlice.actions

export default userSlice.reducer