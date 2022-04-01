import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class DataService {
  url:any = 'http://127.0.0.1:8000';
  constructor(private httpClient:HttpClient) {

  }

  get(endpoint:any){
    return this.httpClient.get(this.url+endpoint);
  }

  post(endpoint:any, data:any){
    return this.httpClient.post(this.url+endpoint, data);
  }

  patch(endpoint:any, data:any){
    return this.httpClient.patch(this.url+endpoint, data);
  }

  delete(endpoint:any){
    return this.httpClient.delete(this.url+endpoint);
  }

}
