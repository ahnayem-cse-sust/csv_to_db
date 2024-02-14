import React from 'react';
import { Sidebar, Menu, MenuItem, SubMenu } from 'react-pro-sidebar';
import { NavLink } from 'react-router-dom';


export default function SidebarComponent() {
	
	return (
		<>
			<Sidebar>
				<Menu
					menuItemStyles={{
					button: {
						// the active class will be added automatically by react router
						// so we can use it to style the active menu item
						[`&.active`]: {
						backgroundColor: '#13395e',
						color: '#b6c8d9',
						},
					},
					}}
				>
					<MenuItem >
						<NavLink
									to="/profile"
									className={({ isActive }) =>
										isActive
											? 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white'
											: 'block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 dark:text-gray-400 md:dark:hover:text-white'
									}>
									Profile
						</NavLink>
					</MenuItem>
					<MenuItem>
						<NavLink
									to="/suit"
									className={({ isActive }) =>
										isActive
											? 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white'
											: 'block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 dark:text-gray-400 md:dark:hover:text-white'
									}>
									Suit
						</NavLink>
					</MenuItem>
					<MenuItem>
						<NavLink
									to="/about"
									className={({ isActive }) =>
										isActive
											? 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white'
											: 'block py-2 pl-3 pr-4 rounded md:bg-transparent md:p-0 dark:text-gray-400 md:dark:hover:text-white'
									}>
									About
						</NavLink>	
					</MenuItem>
				</Menu>
			</Sidebar>
		</>
	);
}