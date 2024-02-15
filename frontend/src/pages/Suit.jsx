import React from 'react';
import axios from '../axios';



export default function Suit() {
	const [error, setError] = React.useState(null);
	const [success, setSuccess] = React.useState(null);

	// login user
	const handleSubmit = async (e) => {
		e.preventDefault();
		
		const { job_date } = e.target.elements;
		const body = {
			job_date: job_date.value,
		};

		try {
			const resp = await axios.get('/suit/'+ body.job_date);
			if (resp.status === 200) {
				setSuccess(resp.response.data.message);
			}
		} catch (error) {
			console.log(error);
			if (error.response.status === 401) {
				setError(error.response.data.message);
			}
		}
	};


	return (
		<>

		<form
		action="#"
		method="post"
		onSubmit={handleSubmit}>
			<div className="grid gap-6 mb-6 md:grid-cols-2">
				<div>
					<label htmlFor="job_date" className="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Input a date to run the job for suit.</label>
					<input 
					type="text" 
					id="job_date" 
					name="job_date"
					className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="20240101" required />
				</div>
			</div>
			<button type="submit" className="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
		</form>	
		</>
	);
}