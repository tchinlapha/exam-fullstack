import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { DataService } from 'src/app/service/data.service';
import { Product } from 'src/app/product';
@Component({
  selector: 'app-store-product',
  templateUrl: './store-product.component.html',
  styleUrls: ['./store-product.component.css']
})
export class StoreProductComponent implements OnInit {
  id:any;
  products:any;
  product:any = new Product();
  categories:any;
  store:any = {};
  detail:any = {};
  constructor(private route:ActivatedRoute, private dataService: DataService) { }

  ngOnInit(): void {
    this.id = this.route.snapshot.params['id'];
    this.getProduct();
    this.getStore();
    this.getProductCategory();
  }

  getProduct(){
    this.dataService.get('/api/product?store_id='+this.id).subscribe((res:any)=>{
      console.log(res)
      if(res.result){
        this.products = res.data;
      }
    })
  }

  getStore(){
    this.dataService.get('/api/store/'+this.id).subscribe((res:any)=>{
      console.log(res)
      if(res.result){
        this.store = res.data;
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
    this.product.store_id = this.id;
    this.dataService.post('/api/product', this.product).subscribe((res:any) =>{
      console.log(res);
      if(res.result){
        this.product = new Product();
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
