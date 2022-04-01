import { Component, OnInit } from '@angular/core';
import { DataService } from 'src/app/service/data.service';
import { Product } from 'src/app/product';
@Component({
  selector: 'app-product',
  templateUrl: './product.component.html',
  styleUrls: ['./product.component.css']
})
export class ProductComponent implements OnInit {
  products:any;
  product:any = new Product();
  categories:any;
  stores:any = [];
  detail:any = {};
  constructor(private dataService: DataService) { }

  ngOnInit(): void {
    this.getProduct();
    this.getStore();
    this.getProductCategory();
  }

  getProduct(){
    this.dataService.get('/api/product').subscribe((res:any)=>{
      console.log(res)
      if(res.result){
        this.products = res.data;
      }
    })
  }

  getStore(){
    this.dataService.get('/api/store').subscribe((res:any)=>{
      console.log(res)
      if(res.result){
        this.stores = res.data;
        this.product.store_id = this.stores[0].id;
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

  viewDetail(product:any){
    this.detail = product;
  }

  submit(){
    this.dataService.post('/api/product', this.product).subscribe((res:any) =>{
      console.log(res);
      if(res.result){
        this.product = new Product();
        this.product.store_id = this.stores[0].id;
        this.getProduct();
      }else{
        alert(JSON.stringify(res.message))
      }
    })
  }

  delete(id:any){
    if(confirm('ต้องการลบสินค้าใช่หรือไม่ ?')){
      this.dataService.delete('/api/product/'+id).subscribe((res:any)=>{
        console.log(res)
        if(res.result){
          this.getProduct();
        }
      })
    }
  }
}
