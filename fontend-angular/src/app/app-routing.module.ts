import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { StoreComponent } from './components/store/store.component';
import { StoreProductComponent } from './components/store-product/store-product.component';
import { ProductComponent } from './components/product/product.component';
import { ProductEditComponent } from './components/product-edit/product-edit.component';
const routes: Routes = [
  {path: '', component: StoreComponent},
  {path: 'store/product/:id', component: StoreProductComponent},
  {path: 'product', component: ProductComponent},
  {path: 'product/:id', component: ProductEditComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
