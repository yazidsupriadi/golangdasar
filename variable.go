package main

import (
	"fmt"
)

func variable() {

	/*
		variable menggunakan var
	*/

	nama := "yazid"
	fmt.Println(nama)

	nama = "yazid supriadi"
	fmt.Println(nama)

	var (
		firstName = "Yazid"
		lastName  = "Supriadi"
	)
	fmt.Println(firstName)
	fmt.Println(lastName)

}
