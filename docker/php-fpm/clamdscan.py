#!/usr/bin/env python

from pyclamd import init_network_socket, scan_file, ScanError
import argparse
import sys

parser = argparse.ArgumentParser()
parser.add_argument('--no-summary', action='store_false', help='Disable summary at end of scanning')
parser.add_argument('--fdpass', action='store_true', help='Pass filedescriptor to clamd (useful if clamd is running as a different user)')
parser.add_argument('file', help='File to scan')
args = parser.parse_args()

try:
    init_network_socket('clamav', 3310)
    err = scan_file(args.file)
    if args.no_summary:
        print err
except ScanError:
    sys.exit(2)

if err == None:
    sys.exit(0)
else:
    print err[args.file] + " FOUND"
    sys.exit(1)
