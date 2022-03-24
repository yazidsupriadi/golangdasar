package main

import (
	"fmt"
)

func slice() {

	var months = []string{
		"January",
		"February",
		"March",
		"April",
		"May",
		"June",
		"July",
		"August",
		"September",
		"October",
		"November",
		"Desember",
	}

	/*
		pointer : 4
		lenght :6
		Capacity :10
	*/
	var slice = months[2:7]

	fmt.Println(slice)
	fmt.Println(len(slice))
	fmt.Println(cap(slice))

}
