package main

import (
	"net/http"
	"time"
)

func init() {
	http.DefaultClient.Timeout = time.Duration(10 * time.Second)
}

var (
	ResponseErrors []string
)

func TrackExists(url string) bool {
	return getStatusCode(url) == 200
}

func appendResponseErrors(err error) {
	ResponseErrors = append(ResponseErrors, err.Error())
}

func getStatusCode(url string) int {
	resp, err := http.Get(url)
	if err != nil {
		appendResponseErrors(err)
		return 404
	}
	return resp.StatusCode
}
