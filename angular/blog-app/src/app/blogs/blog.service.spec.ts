import { TestBed } from '@angular/core/testing';
import { HttpClientTestingModule, HttpTestingController } from '@angular/common/http/testing'

import { BlogService } from './blog.service';

describe('BlogService', () => {
  let service: BlogService;
  let httpCtrl: HttpTestingController;

  const BLOG_RESPONSE = [
    {
      title: "How to create service in Angular",
      content: "Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.",
      createdAt: Date.now(),
      author: "Zainul"
    },
    {
      title: "How to create module in Angular",
      content: "Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.",
      createdAt: Date.now(),
      author: "Zainul"
    }
  ];

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [HttpClientTestingModule]
    });
    service = TestBed.inject(BlogService);
    httpCtrl = TestBed.inject(HttpTestingController);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });

  it('Should return blogs from Http Get call.', () => {
    service.fetchBlogs()
      .subscribe({
        next: (response) => {
          expect(response).toBeTruthy();
          expect(response.length).toBeGreaterThan(1);
        }
      });

    const mockHttp = httpCtrl.expectOne(BlogService.API_ENDPOINT);
    const httpRequest = mockHttp.request;

    expect(httpRequest.method).toEqual("GET");

    mockHttp.flush(BLOG_RESPONSE);

  });

  it('Should return error message for Blog Http request.', ()=>{
    service.fetchBlogs()
    .subscribe({
        error: (error) => {
          expect(error).toBeTruthy();
          expect(error.status).withContext('status').toEqual(401);
        }
    });

    const mockHttp = httpCtrl.expectOne(BlogService.API_ENDPOINT);
    const httpRequest = mockHttp.request;

    mockHttp.flush("error request", { status: 401, statusText: 'Unathorized access' });
  });
});
