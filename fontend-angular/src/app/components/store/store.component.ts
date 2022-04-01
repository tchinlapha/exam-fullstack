import { Component, OnInit } from '@angular/core';
import { DataService } from 'src/app/service/data.service';
import { Store } from 'src/app/store';
@Component({
  selector: 'app-store',
  templateUrl: './store.component.html',
  styleUrls: ['./store.component.css']
})
export class StoreComponent implements OnInit {
  stores:any;
  store = new Store();
  constructor(private dataService: DataService) { }

  ngOnInit(): void {
    this.getStore();
  }

  getStore(){
    this.dataService.get('/api/store').subscribe((res:any) =>{
      if(res.result){
        this.stores = res.data;
        console.log(this.stores)
      }
    })
  }

  submit(){
    this.dataService.post('/api/store', this.store).subscribe((res:any) =>{
      console.log(res);
      if(res.result){
        this.store = new Store();
        this.getStore();
      }else{
        alert(JSON.stringify(res.message))
      }
    })
  }

  detail(id:any){
    alert(id);
  }

}
