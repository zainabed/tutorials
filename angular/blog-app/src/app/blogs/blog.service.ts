import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Blog } from './blog';

@Injectable({
  providedIn: 'root'
})
export class BlogService {

  static readonly API_ENDPOINT = "http://localhost:8090/api/blogs";

  constructor(private http: HttpClient) { }

  public fetchBlogs(): Observable<Blog[]> {
    return this.http.get<Blog[]>(BlogService.API_ENDPOINT);
  }

}
