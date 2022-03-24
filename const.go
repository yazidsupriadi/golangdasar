package main

import "fmt"

func constant() {

	/*
		const keyword
		value gk bisa diubah
	*/
	const nama = "nama constant"
	fmt.Println(nama)

	const (
		firstName = "yazid const"
		lastName  = "supriadi const"
	)
	fmt.Println(firstName, lastName)
}
