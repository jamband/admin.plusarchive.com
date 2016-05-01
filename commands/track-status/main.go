package main

import (
	"bufio"
	"encoding/csv"
	"fmt"
	"io"
	"log"
	"os"
	"path"
	"path/filepath"
	"runtime"
	"strings"
	"sync"
	"time"
)

var (
	success    int
	failure    int
	failedData []string
)

func main() {
	matches, err := filepath.Glob("../../runtime/dump/*.csv")
	if err != nil {
		log.Fatal(err)
	}
	runtime.GOMAXPROCS(runtime.NumCPU())
	var wg sync.WaitGroup

	for _, name := range matches {
		wg.Add(1)
		provider := strings.TrimSuffix(path.Base(name), ".csv")
		f, err := os.Open(name)
		if err != nil {
			log.Fatal(err)
		}
		r := csv.NewReader(bufio.NewReader(f))
		go func() {
			for {
				record, err := r.Read()
				if err == io.EOF {
					break
				}
				if err != nil {
					log.Fatal(err)
				}
				if TrackExists(record[1]) {
					success++
				} else {
					failure++
					failedData = append(failedData, fmt.Sprintf("%s %s %s", record[0], provider, record[1]))
				}
				fmt.Printf("\rSuccess: %d, Failure: %d", success, failure)
				time.Sleep(time.Second) // short break
			}
			wg.Done()
		}()
	}
	wg.Wait()
	if len(failedData) > 0 {
		fmt.Println("\nFailed Lists:")
		for _, v := range failedData {
			fmt.Println(v)
		}
	}
	if len(ResponseErrors) > 0 {
		fmt.Println("\nResponse errors:")
		for _, v := range ResponseErrors {
			fmt.Println(v)
		}
	}
}
