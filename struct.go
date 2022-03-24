package main

import "fmt"

type Customer struct {
	Name    string
	Address string
	Age     int
}

func (customer Customer) sayHai() {
	fmt.Println("hai", customer.Name)
}

func (customer Customer) sayWelcome(name string) {
	fmt.Println("hai", name, ",Welcome from ", customer.Name)
}
