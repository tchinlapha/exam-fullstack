import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';


import { DataService } from 'src/app/service/data.service';
import { Product } from 'src/app/product';
@Component({
  selector: 'app-product-edit',
  templateUrl: './product-edit.component.html',
  styleUrls: ['./product-edit.component.css']
})
export class ProductEditComponent implements OnInit {
  id:any;
  product:any = new Product();
  categories:any;
  stores:any = [];
  detail:any = {};
  constructor(private route:ActivatedRoute, private location: Location, private dataService: DataService) { }

  ngOnInit(): void {
    this.id = this.route.snapshot.params['id'];
    this.getProduct();
    this.getStore();
    this.getProductCategory();
  }

  getProduct(){
    this.dataService.get('/api/product/'+this.id).subscribe((res:any)=>{
      console.log(res)
      if(res.result){
        this.product = res.data;
      }
    })
  }

  getStore(){
    this.dataService.get('/api/store').subscribe((res:any)=>{
      console.log(res)
      if(res.result){
        this.stores = res.data;
      }
    })
  }

  getProductCategory(){
    this.dataService.get('/api/product-category').subscribe((res:any)=>{
      console.log(res)
      if(res.result){
        this.categories = res.data;
      }
    })
  }

  submit(){
    this.dataService.patch('/api/product/'+this.id, this.product).subscribe((res:any) =>{
      console.log(res);
      if(res.result){
        this.location.back();
      }else{
        alert(JSON.stringify(res.message))
      }
    })
  }

}
