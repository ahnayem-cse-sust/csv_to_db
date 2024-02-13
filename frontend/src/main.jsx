import React from 'react'
import ReactDOM from 'react-dom/client'
import './index.css'
import router from './router.jsx';
import { RouterProvider } from 'react-router';
import { AuthProvider } from './contexts/AuthContext';

ReactDOM.createRoot(document.getElementById('root')).render(
  <React.StrictMode>
		<AuthProvider>
			<RouterProvider router={router} />
		</AuthProvider>
	</React.StrictMode>
)
