package org.zain.java.mongodb;

import java.net.UnknownHostException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.List;
import java.util.Set;

import com.mongodb.BasicDBObject;
import com.mongodb.DB;
import com.mongodb.DBCollection;
import com.mongodb.DBCursor;
import com.mongodb.DBObject;
import com.mongodb.Mongo;
import com.mongodb.MongoClient;

/**
 * Hello world!
 * 
 */
public class App {

	public static void main(String[] args) throws ParseException {
		try {

			// MongoClient mongoClient= new MongoClient();

			// MongoClient mongoClient= new MongoClient("localhost");

			MongoClient mongoClient = new MongoClient("localhost", 27017);

			// create or select database
			DB zainabedDB = mongoClient.getDB("zainabed");

			// print all database names
			List<String> databaseNames = mongoClient.getDatabaseNames();

			for (String dbName : databaseNames) {
				System.out.println("Database : " + dbName);
			}

			// select or create collection
			DBCollection personCollection = zainabedDB.getCollection("person");

			// print all collection names
			Set<String> collectionNames = zainabedDB.getCollectionNames();

			for (String collection : collectionNames) {
				System.out.println("collection : " + collection);
			}

			// create person record
			BasicDBObject person = new BasicDBObject()
					.append("username", "zainabed")
					.append("first_name", "Zainul")
					.append("last_name", "Shaikh")
					.append("email", "xyz@gmail.com")
					.append("description", "Software Developer")
					.append("birthdate",
							new SimpleDateFormat("yyyy-MM-dd")
									.parse("1985-03-13"))
					.append("country", "india").append("state", "maharashtra")
					.append("city", "pune").append("job", "Software Developer")
					.append("lat", "18.526895").append("long", "73.856101");

			// insert record into collection
			personCollection.save(person);

			// select person images collection
			DBCollection personImagesCollection = zainabedDB
					.getCollection("person_images");

			// create person image record
			BasicDBObject personImage = new BasicDBObject()
					.append("person_id", person.get("_id"))
					.append("image_path", "/23gfd945j4k4.png")
					.append("width", 400).append("height", 400)
					.append("aspect_ration", 1.0).append("like", 1000)
					.append("dislike", 45);

			// insert person image record into collection
			personImagesCollection.save(personImage);

			// find single record
			DBObject result = personCollection.findOne();
			System.out.println(result);

			// print all person records
			DBCursor personCursor = personCollection.find();

			while (personCursor.hasNext()) {
				System.out.println(personCursor.next());
			}

			// condition object
			BasicDBObject coditionObject = new BasicDBObject("job",
					"Software Developer");

			// find with condition
			result = personCollection.findOne(coditionObject);
			System.out.println(result);

			// update record
			BasicDBObject queryObject = new BasicDBObject("username",
					"zainabed");
			BasicDBObject updateObject = new BasicDBObject("$set",
					new BasicDBObject("email", "abc@gmail.com"));

			personCollection.update(queryObject, updateObject);

			// remove record

			queryObject = new BasicDBObject("email", "abc@gmail.com");

			// personCollection.remove(queryObject);

		} catch (UnknownHostException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}
}
