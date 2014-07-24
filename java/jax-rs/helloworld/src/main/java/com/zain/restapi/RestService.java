package com.zain.restapi;

import javax.ws.rs.GET;
import javax.ws.rs.Path;
import javax.ws.rs.core.Response;

@Path("/message")
public class RestService {

	@GET
	public Response getMessage() {
		String message = "Hello World!";
		return Response.status(200).entity(message).type("text/plain").build();

	}

}
