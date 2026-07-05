import fs from 'fs';
import CourseDB from '../core/CourseDB';
import 'dotenv/config';

(async function update() {
	// update database file
	let courseDB = new CourseDB(process.env.DB_PATH);
	await courseDB.updateAll();

	// update json file
	console.log('Writing result into data/dynamic/all.json ...');
	fs.mkdirSync('data/dynamic', { recursive: true });
	let data = await courseDB.retrieveAll();
	fs.writeFileSync('data/dynamic/all.json', JSON.stringify(data));
	
	// Copy to Laravel public directory
	console.log('Copying result to Laravel public/js/data.json ...');
	fs.writeFileSync('../public/js/data.json', JSON.stringify(data));
	console.log('Done!');
})();
