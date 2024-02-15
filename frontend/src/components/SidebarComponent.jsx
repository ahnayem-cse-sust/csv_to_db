import React from 'react';
import { Sidebar, Menu, MenuItem, SubMenu } from 'react-pro-sidebar';
import { NavLink } from 'react-router-dom';


export default function SidebarComponent() {
	
	return (
		<>
			<Sidebar>
				<Menu className='menu'>
						<NavLink
									to="/profile"
									className={({ isActive }) =>
										isActive
											? 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white'
											: 'block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 dark:text-gray-400 md:dark:hover:text-white'
									}>
									Profile
						</NavLink>
						<NavLink
									to="/suit"
									className={({ isActive }) =>
										isActive
											? 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white'
											: 'block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 dark:text-gray-400 md:dark:hover:text-white'
									}>
									Suit
						</NavLink>
						<NavLink
									to="/about"
									className={({ isActive }) =>
										isActive
											? 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white'
											: 'block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 dark:text-gray-400 md:dark:hover:text-white'
									}>
									About
						</NavLink>	
				</Menu>
			</Sidebar>
		</>
	);
}