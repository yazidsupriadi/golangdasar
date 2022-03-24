package main

import (
	"fmt"
)

func endApp() {

	//fungsi untuk recover  data panic
	//dengan recover program akan terus berjalan walaupun data panic

	message := recover()
	if message != nil {

		fmt.Println("error dengan message :", message)

	}
	fmt.Println("End App")
}

func runApp(error bool) {
	defer endApp()
	if error {
		panic("ERROR")
	}
	fmt.Println("aplikasi Berjalan")
}
