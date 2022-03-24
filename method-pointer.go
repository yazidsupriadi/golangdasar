package main

type Man struct {
	Name string
}

func (man *Man) Married() {
	man.Name = "MR." + man.Name
}
