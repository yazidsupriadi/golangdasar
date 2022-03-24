package main

import "fmt"

func main() {
	fmt.Println("hello word")
	number()
	strings()
	variable()
	constant()
	slice()

	//anonymous function

	blackList := func(name string) bool {
		return name == "admin"
	}

	registerUser("admin", blackList)
	registerUser("Yazid", blackList)

	//recursive
	factorial := factorialLoop(5)
	fmt.Println(factorial)

	factorialRecur := factorialRecursive(5)
	fmt.Print(factorialRecur)

	//closure buat function di dalam function

	counter := 0

	increment := func() {
		fmt.Println("increment")
		counter++
	}
	increment()

	runApplication(1)

	//menampilkan panic

	runApp(true)

	//show struct
	yazid := Customer{
		Name:    "yazid",
		Address: "Jakarta",
		Age:     22,
	}

	fmt.Println(yazid)
	fmt.Println(yazid.Name)
	fmt.Println(yazid.Address)
	fmt.Println(yazid.Age)

	yazid.sayHai()
	yazid.sayWelcome("Budi")

	budi := Person{
		Name: "budi",
	}

	SayHello(budi)

	//pointer

	var address1 = Address{"JAKARTA", "DKI JAKARTA", "INDONESIA"}
	//point by reference
	address2 := address1
	//pointer ikut
	address3 := &address1

	var address4 *Address = &Address{"JAKARTA", "DKI JAKARTA", "INDONESIA"}

	address2.City = "JAKARTA SELATAN"
	ChangeCountryToJapan(address4)
	fmt.Println(address1)
	fmt.Println(address2)
	fmt.Println(address3)

	//ga berubah datanya ketika tidak pakai pointer di fungsi
	//berubah ketika ada pointer di fungsi
	fmt.Println(*address4)

	//method pointer

	person1 := Man{"Yazid"}

	person1.Married()
	fmt.Println(person1)
}
