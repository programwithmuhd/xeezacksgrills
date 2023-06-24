import { defineStore } from 'pinia'
import MenuVue from '@/Pages/Menu.vue';
export const useCartStore = defineStore('cart', {
  state: () => ({ 
    cartContent: {},
  }),
  getters: {
    productsTotal() {
      return Object.keys(this.cartContent).reduce((acc, id) => {
        return acc + this.cartContent[id].quantity;
      }, 0)
    }
  },
  actions: {
    addToCart(id) {
      if(this.cartContent.hasOwnProperty(id)) {
        this.cartContent[id] = {
          id,
          quantity: this.cartContent[id].quantity + 1,
        };
      } else {
        this.cartContent[id] = {
          id,
          quantity: 1,
        }
      }
    },

    removeFromCart(id) {
      if(!this.cartContent[id]) {
        return
      }
      this.cartContent[id].quantity -= 1;

      if(this.cartContent[id].quantity === 0) {
        delete this.cartContent[id]
      }
    },

    removeMenuFromCart(id) {
      delete this.cartContent[id];
    }
},
  persist: true
})