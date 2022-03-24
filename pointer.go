package main

type Address struct {
	City     string
	Province string
	Country  string
}

func ChangeCountryToJapan(address *Address) {
	address.Country = "JAPAN"
}
