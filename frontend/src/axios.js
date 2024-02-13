import Axios from 'axios';

const axios = Axios.create({
	baseURL: "http://localhost:9191/api",
	withCredentials: true,
	headers: {
		"Content-Type": "application/json",
		"Accept": "application/json"
	},
});
axios.defaults.withCredentials = true;
axios.defaults.withXSRFToken = true;


export default axios;